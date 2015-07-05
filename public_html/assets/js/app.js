$(document).ready(function() {
    var appRoot = $('meta[name=origin]').attr('content'),
    t_len = $('meta[name=_token]').length,
    token = t_len?$('meta[name=_token]').attr('content'):null,
    holder = null; // a temporary container

    //ajax request to fetch broadcasters sources
    $("a[data-target='#manageSources']").click(function(e){
        var channelrow = $(this).closest('.channelrow'),
        channel = channelrow.data('channel');
        
        holder = $(this).parent().parent().find('.sourceslist');
        $.post(appRoot+'/admin/servicessource/getSources',{'service':channel['id']})
        .done(function( data ) {
            if(data) {
                $('#tempHolder').html(data);
                $(".chosen-select-sources").chosen({width: "100%"});
                $("#manageSources").modal({backdrop:false});

                //ajax request to save boradcasters sources
                $('button.save').click(function () {
                    var $btn = $(this);
                    $btn.button('loading');
                    var sources = $('#selectSources').val();
                    $.post(appRoot+'/admin/services/livetv/saveSources',{'sources':sources,'service':channel['id'],'_token':token})
                    .done(function( data ) {
                        if(data['status']==="ok") {
                             holder.html(data['view']);
                            $btn.button('reset')
                        }
                    });
                });//end click button.save
            }
        });
    });//end click managesources
//start view,edit click
    $(".b-view,.b-edit").click(function(e){
        var channelrow = $(this).closest('.channelrow'),
        channel = channelrow.data('channel'),
        form = null;
        action = $(this).hasClass('b-view')?'view':'update',
        logoUrl = null;
        var updated = false,
            logoSrcChanged = false;
        $.get(appRoot+'/admin/services/livetv/'+channel['id']+'/?action='+action)
        .done(function( data ) {
            if(data['status']==='ok') {
                var broadcasters = data['broadcasters'],
                    countries = data['countries'];

                $('#tempHolder').html(data['view']);
                $("#managelivetv").modal({backdrop:false});
                form = $("#managelivetv form");
                //ajax request to update live tv
                $('#updatelivetv').click(function () {
                    var $btn = $(this);
                    $btn.button('loading');
                    var livetv = form.serialize(),
                        livetvObj = form.serializeObject();

                    $.post(appRoot+'/admin/services/livetv/'+channel['id'],livetv)
                    .done(function( data ) {
                        if(data['status']==="ok") {
                            $btn.button('reset');
                            updated = true;
                            $.extend(channel, livetvObj);
                           updateIndexData(livetvObj);
                        }
                    });//end post

                });//end click button.save

                //event to handle the change of input type = file for logo
                    $("#logo").change(function(){
                        logoSrcChanged = true;
                    });

                //ajax request to change or set channel logo
                
                $("#changeLogo").click(function(e){
                    e.preventDefault();
                    //return if src is not changed or no logo is supplied
                    if(!logoSrcChanged || $("#logo").val() == ""){
                        return;
                    }


                    var logoForm = document.forms.namedItem("logoForm");
                    var formdata = new FormData(logoForm);


                    var $btn = $(this);
                    $btn.button('loading');
                    $(".b-loading.b-hide").show();

                    $.ajax({
                        url: appRoot+'/admin/services/livetv/setLogo/'+channel['id'], // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: formdata, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData:false,        // To send DOMDocument or non processed data file it is set to false
                        success: function(data)   // A function to be called if request succeeds
                        {
                            if(data['success']==true) {
                                $btn.button('reset');
                                $(".b-loading").hide();
                                updated = true;
                                channel['logo'] = data['logo'];
                                logoUrl = appRoot+data['logopath']+data['logo'];
                                $("#logosrc").attr('src',logoUrl);
                                logoSrcChanged = false;

                                updateIndexData(channel);

                            }
                        }
                    });
                });

                //end ajax request to change or set logo

                //update livetv index data
                function updateIndexData(channel) {
                    channelrow.find('.broadcaster').html(broadcasters[channel['broadcaster_id']]);
                    channelrow.find('.country').html(countries[channel['country_id']]);
                    channelrow.find('.language').html(channel['language']);
                    channelrow.find('.name').html(channel['name']);
                console.log(logoUrl);
                    if(logoUrl){
                        channelrow.find('.logo img').attr('src',logoUrl);
                    }

                }

                //set channel index data to dom
                function setIndexData(channel){
                    //set tr.channelrow data-channel value
                    if(updated){
                        channelrow.attr('data-channel',JSON.stringify(channel));
                    }
                }

                //update view data on livetv update on view tab click
                $('a[href="#view"]').on('shown.bs.tab', function (e) {
                    if(updated){
                            $("#view .name").html(channel['name']);
                            $("#view .broadcaster").html(broadcasters[channel['broadcaster_id']]);
                            $("#view .country").html(countries[channel['country_id']]);
                            $("#view .language").html(channel['language']);
                            $("#view .details").html(channel['details']);
                            if(logoUrl){
                                $("#view .logo").attr('src',logoUrl);
                            }
                            updated = false;
                        }
                    });

            }
        });

    });//end click b-view,b-edit
    
    //start clcik b-remove
    $('.b-remove').click(function(){
        var modal = $("#confirmLiveTvDelete").modal({backdrop:false});
            var channelrow = $(this).closest('.channelrow'),
                channel = channelrow.data('channel');
            $("#confirmLiveTvDelete #deleteLiveTv").click(function(){
                $.post(appRoot+'/admin/services/livetv/'+channel['id'],{_method:'DELETE','_token':token})
                .done(function( data ) {
                        if(data['status']==='ok'){
                           $("#confirmLiveTvDelete").modal('hide');
                           channelrow.slideUp('slow');
                        }
                });//end post
            }); 
    });
    //end clcik b-remove
    
    //start clcik b-toggle-active
    $('.b-toggle-active').click(function(){
            var self = $(this);
            
            var channelrow = $(this).closest('.channelrow'),
                channel = channelrow.data('channel');
                $.post(appRoot+'/admin/services/livetv/toggleActive',{'id':channel['id']})
                .done(function( data ) {
                        if(data['success']==true){
                            var cls = data['active']?'fa-dot-circle-o':'fa-circle-o';
                            self.find('i').removeClass('fa-dot-circle-o fa-circle-o').addClass(cls);
                        }
                });//end post
    });
    //end clcik b-toggle-active

    //start clcik b-toggle-active
    $('.b-toggle-approve').click(function(){
            var self = $(this);
            var channelrow = $(this).closest('.channelrow'),
                channel = channelrow.data('channel');
                $.post(appRoot+'/admin/services/livetv/toggleApprove',{'id':channel['id']})
                .done(function( data ) {
                        if(data['success']==true){
                            var cls = data['approved']?'fa-check-square-o':'fa-square-o';
                            self.find('i').removeClass('fa-check-square-o fa-square-o').addClass(cls);
                        }
                });//end post
    });
    //end clcik b-toggle-active
     
//extend jquery
$.fn.serializeObject = function() {
    var o = {}; 
    var a = this.serializeArray(); 
    $.each(a, function() { 
        if (o[this.name] !== undefined) { 
            if (!o[this.name].push) { 
                o[this.name] = [o[this.name]]; 
            } o[this.name].push(this.value || ''); 
        } else {
         o[this.name] = this.value || ''; }
    }); 
    return o; 
    };

    //automatically send csrf token on post requests
    $.ajaxSetup({
        type:'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

});//end document.ready



function getTableData(dTable, server){
    var selected = [];
    $(dTable).dataTable( {
       "bProcessing": true,
       "bServerSide": true,
       "sAjaxSource": server,
       "iDisplayLength":5,
       "aLengthMenu": [[1, 2, 5, -1],[1, 2, 5, "All"]],
	"columnDefs": [ { //this prevents errors if the data is null
        "targets": "_all",
        "defaultContent": ""
    } ],
    "rowCallback": function( row, data ) {
        if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
            $(row).addClass('selected');
        }
    },
    "columns": [
            //title will auto-generate th columns
            //{ "data" : "name","title" : "Id", "orderable": true, "searchable": true },
            ]
        } );

    $(dTable+' tbody').on('click', 'tr', function () {
        var id = this.id;
        var index = $.inArray(id, selected);

        if ( index === -1 ) {
            selected.push( id );
        } else {
            selected.splice( index, 1 );
        }

        $(this).toggleClass('selected');
    } );
}

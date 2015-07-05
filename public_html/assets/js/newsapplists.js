<<<<<<< HEAD
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

var $_GET = {};

document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
});    

//Global variables
var broadcasters = [];
var appRoot = $('meta[name=origin]').attr('content');

//React
var ApiSources = React.createClass({
	render:function(){
		var singleSource = function(source){
			return (
       <button type="button"  className="btn btn-default btn-xs"> {source['name']}</button>
       )
		}
   return (
    <div>
    {this.props.sources.map(singleSource)}
    </div>
    )
 }
});
var Active = React.createClass({
	render:function(){
		var ActiveBtn;
    if(this.props.data)
     ActiveBtn = <i className="fa fa-dot-circle-o"></i>
   else
    ActiveBtn = <i className="fa fa-circle-o"></i>
  return (
    <ActiveBtn/>
    )
}
});
var SelectBroadcaster = React.createClass({
  render:function(){
    var broadcasterOption = function(broadcaster){
     return (
      <option value={broadcaster['id']} >{broadcaster['display_name']}</option>
      )
   }

   return (
    <select defaultValue={this.props.current['id']} name="broadcaster_id" className="form-control">
    {broadcasters.map(broadcasterOption)};
    </select>
    )
 }
});

var NewsAppSourcesManage = React.createClass({
  getInitialState: function(props){
    props = props||this.props;
    return({
      sources:props.sources,
      serviceId:props.id,
      source:{id:0,name:'',value:''}

    });
  },

  componentWillReceiveProps: function(newProps, oldProps){
   this.setState(this.getInitialState(newProps));
  },
  onNameChange:function(e){
    var source = this.state.source;
    source.name=e.target.value; 
    this.setState({source:source})
  },
  onValueChange:function(e){
    var source = this.state.source;
    source.value=e.target.value; 
    this.setState({source:source})
  },
  onExistingNameChange:function(e){
    var sources = this.state.sources;
    var i = $(e.target).data('index');
    sources[i].name=e.target.value;
    this.setState({sources:sources});
  },
  onExistingValueChange:function(e){
    var sources = this.state.sources;
    var i = $(e.target).data('index');
    sources[i].value=e.target.value;
    this.setState({sources:sources})
  },  
  addSource:function(){
    var sources = this.state.sources.concat(this.state.source);
    this.setState({
      sources:sources,
      source:{id:0,name:'',value:''}
    })
  },
  removeSource:function(e){
    var i = $(e.target).data('index');
    var sources=[];
    $.each(this.state.sources,function(index,v){
      if(index==i)
        return true;
      sources.push(v);
    });
    this.setState(
    {
      sources:sources,
    });



  },
  saveNewsAppSources:function(e){
    var btn = $(e.target);
    btn.button('loading');
    var self = this;
    var data = {id:this.state.serviceId,sources:this.state.sources};
    $.post(appRoot+'/admin/services/newsapp/saveNewsAppSources',data)
    .done(function( response ) {
   if(response['success']){
      self.setState({sources:response['data']});
      self.props.onSave(response['data']);
      btn.button('reset');
   }
   else
      console.log('Server Error');
    });//end post
  },
  render:function(){
    var self = this;

    var getSourceList = function(source, i){
      return (
        <div className="row" key={i}>
        <div className="col-md-4 form-group">
        <input className="form-control" placeholder="Api Name" name="apisources[names][]" type="text" onChange={self.onExistingNameChange} data-index={i} value={source['name']}/>

        </div>
        <div className="col-md-8 input-group form-group">
        <input className="form-control" placeholder="Api URL" name="apisources[values][]" type="text" onChange={self.onExistingValueChange} data-index={i} value={source['value']}/>
        <a href="javascript:void(0)" className="input-group-addon glyphicon btn glyphicon-minus-sign remove-row btn-danger" data-index={i} onClick={self.removeSource}></a>

        </div>
        </div>
        )
    }

    return (
      <form>
      <div className="row">
      <div className="col-md-4">
      <div className="form-group">
      <input className="form-control" placeholder="Api Name" onChange={this.onNameChange} value={this.state.source.name} type="text" />
      </div>
      </div>
      <div className="col-md-8">
      <div className="from-group input-group">
      <input className="form-control" placeholder="Api URL" onChange={this.onValueChange} value={this.state.source.value} type="text"/>
      <a href="javascript:void(0)" className="add-more input-group-addon glyphicon glyphicon-plus-sign btn btn-primary" onClick={this.addSource}></a>
      </div>
      </div>
      </div>
      {this.state.sources.map(getSourceList)}
      <div className="row">
      <div className="col-md-12">
      <div className="form-group">
      <button className="btn btn-primary" data-loading="saving..." type="button" onClick={this.saveNewsAppSources}>Save</button>&nbsp;
      <input className="btn btn-default" type="reset" value="Reset"/>              
      </div>
      </div>
      </div>      
      </form>      
      )
}
});
var NewsAppManage = React.createClass({
  getInitialState:function(){
    return({
      newsApp:this.props.newsApp
    });
  },

  getBroadcaster:function(id){
    var result = $.grep(broadcasters, function(e){ return e.id == id; });
    return result[0];
  },
  saveNewsApp:function(e){
    var btn = $(e.target);
    btn.button('loading');
    var form = $("form[name='newsappupdateform']"),
    data = form.serializeObject(),
    post = form.serialize();
    data['broadcaster'] = this.getBroadcaster(data['broadcaster_id']);
    var self = this;
    $.post(appRoot+'/admin/services/newsapp/saveNewsApp',post)
    .done(function( response ) {
      if(response['success']) {
        var newData = $.extend(self.state.newsApp,data);
        self.setState({newsApp:newData});
        self.props.onSave(newData);
        btn.button('reset');
      }
    });//end post
  },
  render:function(){
    var activeView = this.props.action=='view'?'active':'',
    activeUpdate = this.props.action=='edit'?'active':'';

    var name = this.state.newsApp['name'],
    id = this.state.newsApp['id'],
    broadcaster = this.state.newsApp['broadcaster'];
    return (
      <div className="">
      <ul className="nav nav-tabs">
      <li className={activeView}><a href="#view" data-toggle="tab"><i className="fa fa-bullseye"></i> View</a></li>
      <li className={activeUpdate}><a href="#update" data-toggle="tab"><i className="fa fa-pencil-square"></i> Update</a></li>
      </ul>
      <div className="tab-content bottom-margin">
      <div className={"tab-pane "+activeView} id="view">
      <div className="row">
      <div className="col-md-12">
      <ul className="order-info-list">
      <li>
      <strong>Name : </strong>
      <span>{name}</span>
      </li>
      <li>
      <strong>Broadcaster : </strong>
      <span>{broadcaster['display_name']}</span>
      </li>
      </ul>   
      </div>
      </div>

      </div>
      <div className={activeUpdate+" tab-pane"} id="update">
      <form name="newsappupdateform">
      <input type="hidden" name="id" value={id} />
      <div className="row-fluid">
      <div className="col-md-12">           
      <div className="form-group">
      <label>Name</label>
      <input type="text" name="name" defaultValue={this.state.newsApp['name']} className="form-control"/>
      </div>
      <div className="form-group">
      <label>Broadcaster</label>
      <SelectBroadcaster current={broadcaster}/>
      </div>

      <div className="form-group">
      <button className="btn btn-primary" data-loading="saving..." type="button" onClick={this.saveNewsApp}>Save</button>&nbsp;
      <input className="btn btn-default" type="reset" value="Reset"/>              
      </div>
      </div>
      </div>
      </form>
      </div>
      </div>
      </div>

      )
}
});

var NewsApp = React.createClass({
	getInitialState: function(props) {

    props = props||this.props;
   return {
    newsApp:props.data,
    manageSourcesClicked:false,
  }
},
componentDidMount: function(){
//this.setState({newsApp:this.props.data});
},
componentWillReceiveProps: function(newProps, oldProps){
    this.setState(this.getInitialState(newProps));
},
saveNewsApp : function(data){
    this.setState({newsApp:data});
},

setNewsAppSources : function(sources){
  this.setState({});
},
manageNewsApp: function(e){
  var action = $(e.target).parent().attr('title');
  //$("#newsAppManage").html("");
  React.render(<NewsAppManage onSave={this.saveNewsApp} action={action} newsApp={this.state.newsApp}/>,document.getElementById("newsAppManage"));
  $('#newsAppModal').modal({backdrop:false});
},
manageSources: function(e){
    React.render(<NewsAppSourcesManage id={this.state.newsApp['id']} onSave={this.setNewsAppSources} sources={this.state.newsApp['sources']}/>,
      document.getElementById("newsAppSourcesManage")
      );
  $("#newsAppSourcesModal").modal({backdrop:false});
},
toggleActive:function(e){
    var self = this;
    $.post(appRoot+'/admin/services/newsapp/toggleActive',"id="+this.state.newsApp['id'])
    .done(function( response ) {
      if(response['success']) {
        var newsApp = self.state.newsApp;
        newsApp['active'] = response['active'];
        self.setState({newsApp:newsApp});
      }
    });//end post
},
toggleApprove:function(e){
    var self = this;
    $.post(appRoot+'/admin/services/newsapp/toggleApprove',"id="+this.state.newsApp['id'])
    .done(function( response ) {
      if(response['success']) {
        var newsApp = self.state.newsApp;
        newsApp['approved'] = response['approved'];
        self.setState({newsApp:newsApp});
      }
    });//end post
},
render:function(){
  var activeIcon = this.props.data['active']?"fa-dot-circle-o":"fa-circle-o",
      approvedIcon = this.props.data['approved']?"fa-check-square-o":"fa-square-o";
  return (
    <tr>
    <td><div className="checkbox"><input type="checkbox" /></div></td>
    <td>
    {this.props.data['name']}
    </td>
    <td className="broadcaster">
    {this.props.data['broadcaster']['display_name']}
    </td>
    <td className="sourceslist">
    {this.props.data['sources'].length ?
    [<ApiSources  key={this.props.data['id']} sources={this.props.data['sources']}/>]:
    ['No sources defined']
  }
  </td>
  <td>
  <a href="javascript:void(0)" data-target="#manageSources" onClick={this.manageSources}><i className="fa fa-pencil-square-o"></i></a>
  </td>
  <td className="">
  <a href="javascript:void(0)" className="b-view" title="view"  onClick={this.manageNewsApp}><i className="fa fa-eye"></i></a>&nbsp;
  <a href="javascript:void(0)" className="b-edit" title="edit"  onClick={this.manageNewsApp}><i className="fa fa-pencil"></i></a>&nbsp;
  </td>
  <td>
  <a href="javascript:void(0)" className="b-toggle-active" title="toggle active" onClick={this.toggleActive}>
  <i className={"fa "+activeIcon}></i>

</a>&nbsp;
<a href="javascript:void(0)" className="b-toggle-approve" title="toggle approve" onClick={this.toggleApprove}>
  <i className={"fa "+approvedIcon}></i>
</a>
</td>
</tr>
)
}
});

var NewsAppsTableHead = React.createClass({
	render: function(){
		return (
      <thead>
      <tr>
      <th>
      <div className="checkbox">
      <input type="checkbox"/></div>
      </th>
      <th>App Name</th>
      <th>Broadcaster</th>
      <th colSpan="2">Api Sources</th>
      <th colSpan="2"></th>
      </tr>
      </thead>
      )
	}
});

var CbsModal = React.createClass({
  render:function(){
    var icon = this.props.icon?this.props.icon:'',
    expand = this.props.expand?'':'hide',
    remove = this.props.remove?'':'hide',
    action = this.props.action?this.props.action:'view';
    return (
      <div className="modal fade" id={this.props.modalid} tabindex="-1" role="dialog" aria-labelledby="modalFormStyle1Label" aria-hidden="true">
      <div className="modal-dialog">
      <div className="modal-content">
      <div className="widget widget-blue">
      <div className="widget-title">
      <div className="widget-controls">
      <a href="#" className={"widget-control widget-control-full-screen "+ expand} data-toggle="tooltip" data-placement="top" title="" data-original-title="Full Screen"><i className="fa fa-expand"></i></a>
      <a href="#" className="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i className="fa fa-expand"></i></a>
      <a href="#" className={"widget-control widget-control-remove close" +remove} data-dismiss='modal' data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><i className="fa fa-times-circle"></i></a>
      </div>
      <h3><i className={"fa "+ icon}></i> {this.props.title || 'Lists'}</h3>
      </div>
      </div>
      <div className="widget-content" id={this.props.contentid}>
      </div>
      </div>
      </div>
      </div>
      );
}
});
var NewsAppBox = React.createClass({
  getInitialState: function() {
    return {
    	newsApps:[],
    };
  },

  componentDidMount: function() {
    var filter="";
    if($_GET['filter']=="all")
        filter = "?filter=all";
    $.get(this.props.source+filter, function(result) {
      var responseLists = $.map(result['data'], function(el) { return el; });
      broadcasters = $.map(result['broadcasters'], function(el) { return el; });//assigned to global broadcasters variables

      if (this.isMounted()) {
        this.setState({
          newsApps: responseLists,
        });
      }
    }.bind(this));
  },

  render: function() {
  	var newsAppList = function(newsApp){
  		return (
  			<NewsApp data={newsApp}/>
        )
  	}
    return (
      <div>
      <table className="table table-bordered table-hover datatable">
      <NewsAppsTableHead/>
      <tbody>
      {this.state.newsApps.map(newsAppList)}
      </tbody>
      </table>
      <CbsModal title="Manage News App" remove="true" icon="fa-bullseye" modalid="newsAppModal" contentid="newsAppManage"/>
      <CbsModal title="Manage News App Sources" remove="true" icon="fa-bullseye" modalid="newsAppSourcesModal" contentid="newsAppSourcesManage"/>
      </div>
      );
  }
});

React.render(
  <NewsAppBox source={appRoot+"/admin/services/newsapp"} />,
  document.getElementById('newsapps')
=======
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

var $_GET = {};

document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
});    

//Global variables
var broadcasters = [];
var appRoot = $('meta[name=origin]').attr('content');

//React
var ApiSources = React.createClass({
	render:function(){
		var singleSource = function(source){
			return (
       <button type="button"  className="btn btn-default btn-xs"> {source['name']}</button>
       )
		}
   return (
    <div>
    {this.props.sources.map(singleSource)}
    </div>
    )
 }
});
var Active = React.createClass({
	render:function(){
		var ActiveBtn;
    if(this.props.data)
     ActiveBtn = <i className="fa fa-dot-circle-o"></i>
   else
    ActiveBtn = <i className="fa fa-circle-o"></i>
  return (
    <ActiveBtn/>
    )
}
});
var SelectBroadcaster = React.createClass({
  render:function(){
    var broadcasterOption = function(broadcaster){
     return (
      <option value={broadcaster['id']} >{broadcaster['display_name']}</option>
      )
   }

   return (
    <select defaultValue={this.props.current['id']} name="broadcaster_id" className="form-control">
    {broadcasters.map(broadcasterOption)};
    </select>
    )
 }
});

var NewsAppSourcesManage = React.createClass({
  getInitialState: function(props){
    props = props||this.props;
    return({
      sources:props.sources,
      serviceId:props.id,
      source:{id:0,name:'',value:''}

    });
  },

  componentWillReceiveProps: function(newProps, oldProps){
   this.setState(this.getInitialState(newProps));
  },
  onNameChange:function(e){
    var source = this.state.source;
    source.name=e.target.value; 
    this.setState({source:source})
  },
  onValueChange:function(e){
    var source = this.state.source;
    source.value=e.target.value; 
    this.setState({source:source})
  },
  onExistingNameChange:function(e){
    var sources = this.state.sources;
    var i = $(e.target).data('index');
    sources[i].name=e.target.value;
    this.setState({sources:sources});
  },
  onExistingValueChange:function(e){
    var sources = this.state.sources;
    var i = $(e.target).data('index');
    sources[i].value=e.target.value;
    this.setState({sources:sources})
  },  
  addSource:function(){
    var sources = this.state.sources.concat(this.state.source);
    this.setState({
      sources:sources,
      source:{id:0,name:'',value:''}
    })
  },
  removeSource:function(e){
    var i = $(e.target).data('index');
    var sources=[];
    $.each(this.state.sources,function(index,v){
      if(index==i)
        return true;
      sources.push(v);
    });
    this.setState(
    {
      sources:sources,
    });



  },
  saveNewsAppSources:function(e){
    var btn = $(e.target);
    btn.button('loading');
    var self = this;
    var data = {id:this.state.serviceId,sources:this.state.sources};
    $.post(appRoot+'/admin/services/newsapp/saveNewsAppSources',data)
    .done(function( response ) {
   if(response['success']){
      self.setState({sources:response['data']});
      self.props.onSave(response['data']);
      btn.button('reset');
   }
   else
      console.log('Server Error');
    });//end post
  },
  render:function(){
    var self = this;

    var getSourceList = function(source, i){
      return (
        <div className="row" key={i}>
        <div className="col-md-4 form-group">
        <input className="form-control" placeholder="Api Name" name="apisources[names][]" type="text" onChange={self.onExistingNameChange} data-index={i} value={source['name']}/>

        </div>
        <div className="col-md-8 input-group form-group">
        <input className="form-control" placeholder="Api URL" name="apisources[values][]" type="text" onChange={self.onExistingValueChange} data-index={i} value={source['value']}/>
        <a href="javascript:void(0)" className="input-group-addon glyphicon btn glyphicon-minus-sign remove-row btn-danger" data-index={i} onClick={self.removeSource}></a>

        </div>
        </div>
        )
    }

    return (
      <form>
      <div className="row">
      <div className="col-md-4">
      <div className="form-group">
      <input className="form-control" placeholder="Api Name" onChange={this.onNameChange} value={this.state.source.name} type="text" />
      </div>
      </div>
      <div className="col-md-8">
      <div className="from-group input-group">
      <input className="form-control" placeholder="Api URL" onChange={this.onValueChange} value={this.state.source.value} type="text"/>
      <a href="javascript:void(0)" className="add-more input-group-addon glyphicon glyphicon-plus-sign btn btn-primary" onClick={this.addSource}></a>
      </div>
      </div>
      </div>
      {this.state.sources.map(getSourceList)}
      <div className="row">
      <div className="col-md-12">
      <div className="form-group">
      <button className="btn btn-primary" data-loading="saving..." type="button" onClick={this.saveNewsAppSources}>Save</button>&nbsp;
      <input className="btn btn-default" type="reset" value="Reset"/>              
      </div>
      </div>
      </div>      
      </form>      
      )
}
});
var NewsAppManage = React.createClass({
  getInitialState:function(){
    return({
      newsApp:this.props.newsApp
    });
  },

  getBroadcaster:function(id){
    var result = $.grep(broadcasters, function(e){ return e.id == id; });
    return result[0];
  },
  saveNewsApp:function(e){
    var btn = $(e.target);
    btn.button('loading');
    var form = $("form[name='newsappupdateform']"),
    data = form.serializeObject(),
    post = form.serialize();
    data['broadcaster'] = this.getBroadcaster(data['broadcaster_id']);
    var self = this;
    $.post(appRoot+'/admin/services/newsapp/saveNewsApp',post)
    .done(function( response ) {
      if(response['success']) {
        var newData = $.extend(self.state.newsApp,data);
        self.setState({newsApp:newData});
        self.props.onSave(newData);
        btn.button('reset');
      }
    });//end post
  },
  render:function(){
    var activeView = this.props.action=='view'?'active':'',
    activeUpdate = this.props.action=='edit'?'active':'';

    var name = this.state.newsApp['name'],
    id = this.state.newsApp['id'],
    broadcaster = this.state.newsApp['broadcaster'];
    return (
      <div className="">
      <ul className="nav nav-tabs">
      <li className={activeView}><a href="#view" data-toggle="tab"><i className="fa fa-bullseye"></i> View</a></li>
      <li className={activeUpdate}><a href="#update" data-toggle="tab"><i className="fa fa-pencil-square"></i> Update</a></li>
      </ul>
      <div className="tab-content bottom-margin">
      <div className={"tab-pane "+activeView} id="view">
      <div className="row">
      <div className="col-md-12">
      <ul className="order-info-list">
      <li>
      <strong>Name : </strong>
      <span>{name}</span>
      </li>
      <li>
      <strong>Broadcaster : </strong>
      <span>{broadcaster['display_name']}</span>
      </li>
      </ul>   
      </div>
      </div>

      </div>
      <div className={activeUpdate+" tab-pane"} id="update">
      <form name="newsappupdateform">
      <input type="hidden" name="id" value={id} />
      <div className="row-fluid">
      <div className="col-md-12">           
      <div className="form-group">
      <label>Name</label>
      <input type="text" name="name" defaultValue={this.state.newsApp['name']} className="form-control"/>
      </div>
      <div className="form-group">
      <label>Broadcaster</label>
      <SelectBroadcaster current={broadcaster}/>
      </div>

      <div className="form-group">
      <button className="btn btn-primary" data-loading="saving..." type="button" onClick={this.saveNewsApp}>Save</button>&nbsp;
      <input className="btn btn-default" type="reset" value="Reset"/>              
      </div>
      </div>
      </div>
      </form>
      </div>
      </div>
      </div>

      )
}
});

var NewsApp = React.createClass({
	getInitialState: function(props) {

    props = props||this.props;
   return {
    newsApp:props.data,
    manageSourcesClicked:false,
  }
},
componentDidMount: function(){
//this.setState({newsApp:this.props.data});
},
componentWillReceiveProps: function(newProps, oldProps){
    this.setState(this.getInitialState(newProps));
},
saveNewsApp : function(data){
    this.setState({newsApp:data});
},

setNewsAppSources : function(sources){
  this.setState({});
},
manageNewsApp: function(e){
  var action = $(e.target).parent().attr('title');
  //$("#newsAppManage").html("");
  React.render(<NewsAppManage onSave={this.saveNewsApp} action={action} newsApp={this.state.newsApp}/>,document.getElementById("newsAppManage"));
  $('#newsAppModal').modal({backdrop:false});
},
manageSources: function(e){
    React.render(<NewsAppSourcesManage id={this.state.newsApp['id']} onSave={this.setNewsAppSources} sources={this.state.newsApp['sources']}/>,
      document.getElementById("newsAppSourcesManage")
      );
  $("#newsAppSourcesModal").modal({backdrop:false});
},
toggleActive:function(e){
    var self = this;
    $.post(appRoot+'/admin/services/newsapp/toggleActive',"id="+this.state.newsApp['id'])
    .done(function( response ) {
      if(response['success']) {
        var newsApp = self.state.newsApp;
        newsApp['active'] = response['active'];
        self.setState({newsApp:newsApp});
      }
    });//end post
},
toggleApprove:function(e){
    var self = this;
    $.post(appRoot+'/admin/services/newsapp/toggleApprove',"id="+this.state.newsApp['id'])
    .done(function( response ) {
      if(response['success']) {
        var newsApp = self.state.newsApp;
        newsApp['approved'] = response['approved'];
        self.setState({newsApp:newsApp});
      }
    });//end post
},
render:function(){
  var activeIcon = this.props.data['active']?"fa-dot-circle-o":"fa-circle-o",
      approvedIcon = this.props.data['approved']?"fa-check-square-o":"fa-square-o";
  return (
    <tr>
    <td><div className="checkbox"><input type="checkbox" /></div></td>
    <td>
    {this.props.data['name']}
    </td>
    <td className="broadcaster">
    {this.props.data['broadcaster']['display_name']}
    </td>
    <td className="sourceslist">
    {this.props.data['sources'].length ?
    [<ApiSources  key={this.props.data['id']} sources={this.props.data['sources']}/>]:
    ['No sources defined']
  }
  </td>
  <td>
  <a href="javascript:void(0)" data-target="#manageSources" onClick={this.manageSources}><i className="fa fa-pencil-square-o"></i></a>
  </td>
  <td className="">
  <a href="javascript:void(0)" className="b-view" title="view"  onClick={this.manageNewsApp}><i className="fa fa-eye"></i></a>&nbsp;
  <a href="javascript:void(0)" className="b-edit" title="edit"  onClick={this.manageNewsApp}><i className="fa fa-pencil"></i></a>&nbsp;
  </td>
  <td>
  <a href="javascript:void(0)" className="b-toggle-active" title="toggle active" onClick={this.toggleActive}>
  <i className={"fa "+activeIcon}></i>

</a>&nbsp;
<a href="javascript:void(0)" className="b-toggle-approve" title="toggle approve" onClick={this.toggleApprove}>
  <i className={"fa "+approvedIcon}></i>
</a>
</td>
</tr>
)
}
});

var NewsAppsTableHead = React.createClass({
	render: function(){
		return (
      <thead>
      <tr>
      <th>
      <div className="checkbox">
      <input type="checkbox"/></div>
      </th>
      <th>App Name</th>
      <th>Broadcaster</th>
      <th colSpan="2">Api Sources</th>
      <th colSpan="2"></th>
      </tr>
      </thead>
      )
	}
});

var CbsModal = React.createClass({
  render:function(){
    var icon = this.props.icon?this.props.icon:'',
    expand = this.props.expand?'':'hide',
    remove = this.props.remove?'':'hide',
    action = this.props.action?this.props.action:'view';
    return (
      <div className="modal fade" id={this.props.modalid} tabindex="-1" role="dialog" aria-labelledby="modalFormStyle1Label" aria-hidden="true">
      <div className="modal-dialog">
      <div className="modal-content">
      <div className="widget widget-blue">
      <div className="widget-title">
      <div className="widget-controls">
      <a href="#" className={"widget-control widget-control-full-screen "+ expand} data-toggle="tooltip" data-placement="top" title="" data-original-title="Full Screen"><i className="fa fa-expand"></i></a>
      <a href="#" className="widget-control widget-control-full-screen widget-control-show-when-full" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exit Full Screen"><i className="fa fa-expand"></i></a>
      <a href="#" className={"widget-control widget-control-remove close" +remove} data-dismiss='modal' data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><i className="fa fa-times-circle"></i></a>
      </div>
      <h3><i className={"fa "+ icon}></i> {this.props.title || 'Lists'}</h3>
      </div>
      </div>
      <div className="widget-content" id={this.props.contentid}>
      </div>
      </div>
      </div>
      </div>
      );
}
});
var NewsAppBox = React.createClass({
  getInitialState: function() {
    return {
    	newsApps:[],
    };
  },

  componentDidMount: function() {
    var filter="";
    if($_GET['filter']=="all")
        filter = "?filter=all";
    $.get(this.props.source+filter, function(result) {
      var responseLists = $.map(result['data'], function(el) { return el; });
      broadcasters = $.map(result['broadcasters'], function(el) { return el; });//assigned to global broadcasters variables

      if (this.isMounted()) {
        this.setState({
          newsApps: responseLists,
        });
      }
    }.bind(this));
  },

  render: function() {
  	var newsAppList = function(newsApp){
  		return (
  			<NewsApp data={newsApp}/>
        )
  	}
    return (
      <div>
      <table className="table table-bordered table-hover datatable">
      <NewsAppsTableHead/>
      <tbody>
      {this.state.newsApps.map(newsAppList)}
      </tbody>
      </table>
      <CbsModal title="Manage News App" remove="true" icon="fa-bullseye" modalid="newsAppModal" contentid="newsAppManage"/>
      <CbsModal title="Manage News App Sources" remove="true" icon="fa-bullseye" modalid="newsAppSourcesModal" contentid="newsAppSourcesManage"/>
      </div>
      );
  }
});

React.render(
  <NewsAppBox source={appRoot+"/admin/services/newsapp"} />,
  document.getElementById('newsapps')
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
  );
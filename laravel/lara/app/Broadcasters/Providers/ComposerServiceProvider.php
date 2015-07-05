<<<<<<< HEAD
<?php namespace Broadcasters\Providers;

use View;
use Illuminate\Support\ServiceProvider;

use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot(BroadcasterServiceProvider $broadcasterServiceProvider)
    {
        // Using class based composers...
        //View::composer('profile', 'App\Http\ViewComposers\ProfileComposer');

        // Using Closure based composers...
        View::composer(['admin/*','broadcaster/*'], function($view)
        {
            $view->with('cbs_options',\Config::get('site'));
        });

        View::composer('broadcaster/*', function($view) use ($broadcasterServiceProvider)
        {
            if(\Auth::check()){
                $view->with('cbs_services',$broadcasterServiceProvider->getBroadcasterServices());               
            }
        }

        );        

    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }

=======
<?php namespace Broadcasters\Providers;

use View;
use Illuminate\Support\ServiceProvider;

use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot(BroadcasterServiceProvider $broadcasterServiceProvider)
    {
        // Using class based composers...
        //View::composer('profile', 'App\Http\ViewComposers\ProfileComposer');

        // Using Closure based composers...
        View::composer(['admin/*','broadcaster/*'], function($view)
        {
            $view->with('cbs_options',\Config::get('site'));
        });

        View::composer('broadcaster/*', function($view) use ($broadcasterServiceProvider)
        {
            if(\Auth::check()){
                $view->with('cbs_services',$broadcasterServiceProvider->getBroadcasterServices());               
            }
        }

        );        

    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }

>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}
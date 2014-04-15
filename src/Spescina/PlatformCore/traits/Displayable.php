<?php namespace Spescina\PlatformCore\Traits;

use Illuminate\Support\Facades\View;

trait Displayable {

        public function show()
        {
                $view = View::make('platform-core::' . $this->view);

                if ($this->viewData)
                {
                        $view->with('obj', $this);
                }

                return $view->render();
        }

}

<?php namespace Anomaly\Streams\Platform\Image\Command;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Image\Image;
use Illuminate\Contracts\Container\Container;

/**
 * Class AddImageNamespaces
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AddImageNamespaces
{

    /**
     * Handle the command.
     */
    public function handle(Image $image, Container $container, Application $application)
    {
        $image->addPath('public', base_path('public'));
        $image->addPath('node', base_path('node_modules'));
        $image->addPath('asset', $application->getAssetsPath());
        $image->addPath('streams', $container->make('streams.path') . '/resources');
        $image->addPath('bower', $container->make('path.base') . '/bin/bower_components');
    }
}

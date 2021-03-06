<?php
/**
 * This file is part of the "Lost and Found" project
 *
 * @copyright Stfalcon.com <info@stfalcon.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * Class AppKernel
 *
 * @author Artem Genvald      <genvaldartem@gmail.com>
 * @author Yuri Svatok        <svatok13@gmail.com>
 * @author Andrew Prohorovych <prohorovychua@gmail.com>
 * @author Oleg Kachinsky     <logansoleg@gmail.com>
 */
class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function __construct($environment, $debug)
    {
        parent::__construct($environment, $debug);

        // Set UTC timezone for all application dates
        date_default_timezone_set('UTC');
    }

    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            // Doctrine related bundles
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Fresh\DoctrineEnumBundle\FreshDoctrineEnumBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            // Sonata related bundles
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\SeoBundle\SonataSeoBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new CoopTilleuls\Bundle\CKEditorSonataMediaBundle\CoopTilleulsCKEditorSonataMediaBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),
            // User related bundles
            new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            // Media related bundles
            new Vich\UploaderBundle\VichUploaderBundle(),
            // Translation and routing related bundles
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
            new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),
            new JMS\TranslationBundle\JMSTranslationBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            // API related bundles
            new FOS\RestBundle\FOSRestBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            // Application bundles
            new AppBundle\AppBundle(),
            new MediaBundle\MediaBundle(),
        ];

        if ($this->getEnvironment() == 'prod') {
            $bundles[] = new \Ftrrtf\RollbarBundle\FtrrtfRollbarBundle();
        }

        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        if ($this->getEnvironment() == 'test') {
            $bundles[] = new Liip\FunctionalTestBundle\LiipFunctionalTestBundle();
        }

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}

<?php
namespace Xaben\FacebookBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class FacebookSPExtension extends \Twig_Extension
{
    protected $container;
    protected $options;

    public function __construct(ContainerInterface $container = null, $options = array())
    {
        $this->container = $container;
        $this->options = $options;
        //var_dump($options);
    }

    public function getFunctions()
    {
        return array(
            'xfb_sdkinit'  => new \Twig_Function_Method($this, 'SDKInitFunction', array('is_safe'=>array('html'))),
            'xfb_xfbmlinit'  => new \Twig_Function_Method($this, 'XFBMLInitFunction', array('is_safe'=>array('html'))),
            'xfb_like_button'  => new \Twig_Function_Method($this, 'LikeButtonFunction', array('is_safe'=>array('html'))),
            'xfb_share_button'  => new \Twig_Function_Method($this, 'ShareButtonFunction', array('is_safe'=>array('html'))),
        );
    }

    public function SDKInitFunction()
    {
        $engine = $this->container->get('templating');
        return $engine->render('XabenFacebookBundle::init_sdk.html.twig', array(
                'app_id'=>$this->options['app_id'],
                'locale'=>$this->options['locale']
            ));

    }

    public function XFBMLInitFunction()
    {
        $engine = $this->container->get('templating');
        return $engine->render('XabenFacebookBundle::init_xfbml.html.twig');
    }

    public function LikeButtonFunction($url, $options = array())
    {
        $options = array_merge($this->options['like'], array('mode'=>$this->options['default_mode'], 'app_id'=>$this->options['app_id'],'locale'=>$this->options['locale']), $options);

        if ($options['layout'] == 'standard' && $options['show_faces'] == true){
            $options['height'] = 80;
        } elseif ($options['layout'] == 'standard' && $options['show_faces'] == false){
            $options['height'] = 35;
        }elseif ($options['layout'] == 'box_count'){
            $options['height'] = 65;
        }elseif ($options['layout'] == 'button_count'){
            $options['height'] = 20;
        }

        $engine = $this->container->get('templating');
        return $engine->render('XabenFacebookBundle:'.$options['mode'].':like_button.html.twig', array('url'=>$url,'options'=>$options));
    }

    public function ShareButtonFunction($url, $options = array())
    {
        $options = array_merge($this->options['share'], array('mode'=>$this->options['default_mode']), $options);

        $engine = $this->container->get('templating');
        return $engine->render('XabenFacebookBundle:'.$options['mode'].':share_button.html.twig', array('url'=>$url,'options'=>$options));
    }


    public function getName()
    {
        return 'xaben_fbsp_extension';
    }
}
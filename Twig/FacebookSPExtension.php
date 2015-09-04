<?php
namespace Xaben\FacebookBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class FacebookSPExtension extends \Twig_Extension
{
    protected $container;
    protected $options;

    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->options = $this->container->getParameter("xaben.facebook.config");
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('xfb_sdkinit', array($this, 'SDKInitFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_xfbmlinit', array($this, 'XFBMLInitFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_like_button', array($this, 'LikeButtonFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_share_button', array($this, 'ShareButtonFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_send_button', array($this, 'SendButtonFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_embedded_posts', array($this, 'EmbeddedPostsFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_follow_button', array($this, 'FollowButtonFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_comments', array($this, 'CommentsFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_activity_feed', array($this, 'ActivityFeedFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_recommendations_feed', array($this, 'RecommendationsFeedFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_recommendations_bar', array($this, 'RecommendationsBarFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_like_box', array($this, 'LikeBoxFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_register', array($this, 'RegisterFunction', array('is_safe'=>array('html')))),
            new Twig_SimpleFunction('xfb_facepile', array($this, 'FacepileFunction', array('is_safe'=>array('html')))),
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

        if ($options['layout'] == 'standard' && $options['show_faces'] == true) {
            $options['height'] = 80;
        } elseif ($options['layout'] == 'standard' && $options['show_faces'] == false) {
            $options['height'] = 35;
        } elseif ($options['layout'] == 'box_count') {
            $options['height'] = 65;
        } elseif ($options['layout'] == 'button_count') {
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

    public function SendButtonFunction($url, $options = array())
    {
        $options = array_merge($this->options['send'], array('mode'=>$this->options['default_mode']), $options);
        $engine = $this->container->get('templating');

        return $engine->render('XabenFacebookBundle:'.$options['mode'].':send_button.html.twig', array('url'=>$url,'options'=>$options));
    }

    public function EmbeddedPostsFunction($url, $options = array())
    {
        $options = array_merge($this->options['embedded_posts'], array('mode'=>$this->options['default_mode']), $options);
        $engine = $this->container->get('templating');

        return $engine->render('XabenFacebookBundle:'.$options['mode'].':embedded_posts.html.twig', array('url'=>$url,'options'=>$options));
    }

    public function FollowButtonFunction($url, $options = array())
    {
        $options = array_merge($this->options['follow'], array(
                'mode'=>$this->options['default_mode'],
                'app_id'=>$this->options['app_id'],
                'locale'=>$this->options['locale']
            ), $options);

        $engine = $this->container->get('templating');

        return $engine->render('XabenFacebookBundle:'.$options['mode'].':follow_button.html.twig', array('url'=>$url,'options'=>$options));
    }

    public function CommentsFunction($url, $options = array())
    {
        $options = array_merge($this->options['comments'], array('mode'=>$this->options['default_mode']), $options);

        $engine = $this->container->get('templating');

        return $engine->render('XabenFacebookBundle:'.$options['mode'].':comments.html.twig', array('url'=>$url,'options'=>$options));
    }

    public function ActivityFeedFunction($url, $options = array())
    {
    }

    public function RecommendationsFeedFunction($url, $options = array())
    {
    }

    public function RecommendationsBarFunction($url, $options = array())
    {
    }

    public function LikeBoxFunction($url, $options = array())
    {
        $options = array_merge($this->options['like_box'], array('mode'=>$this->options['default_mode'], 'app_id'=>$this->options['app_id'],'locale'=>$this->options['locale']), $options);

        $engine = $this->container->get('templating');

        return $engine->render('XabenFacebookBundle:'.$options['mode'].':like_box.html.twig', array('url'=>$url,'options'=>$options));
    }

    public function RegisterFunction($url, $options = array())
    {
    }

    public function FacepileFunction($url, $options = array())
    {
    }

    public function getName()
    {
        return 'xaben_fbsp_extension';
    }
}

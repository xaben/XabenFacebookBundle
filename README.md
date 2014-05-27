XabenFacebookBundle - Facebook social plugins integration for symfony2
================================================

The ``XabenFacebookBundle`` is a bundle providing twig extensions and exposing general configuration for all the current Facebook social plugins

The following twig extensions are available:
<pre>
-    xfb_sdkinit
-    xfb_xfbmlinit
-    xfb_like_button
-    xfb_share_button
-    xfb_send_button
-    xfb_embedded_posts
-    xfb_follow_button
-    xfb_comments
-    xfb_activity_feed
-    xfb_recommendations_feed
-    xfb_recommendations_bar
-    xfb_like_box
-    xfb_register
-    xfb_facepile
</pre>

Configuration
================================================
<pre>
xaben_facebook:
    default_mode:         ~ # One of "html5"; "xfbml"; "iframe"; "url"
    app_id:               ~
    locale:               en_US
    like:
        width:                '450'
        layout:               ~ # One of "standard"; "box_count"; "button_count"; "button"
        action:               ~ # One of "like"; "recommend"
        show_faces:           false
        share:                false
        colorscheme:          ~ # One of "light"; "dark"
        kid_directed_site:    false
        ref:                  null
    share:
        width:                '1'
        layout:               ~ # One of "box_count"; "button_count"; "button"; "icon"; "icon_link"; "link"
    send:
        width:                '450'
        height:               '0'
        colorscheme:          ~ # One of "light"; "dark"
        kid_directed_site:    false
        ref:                  null
    embedded_posts:
        width:                '500'
    follow:
        width:                '450'
        height:               '80'
        layout:               ~ # One of "standard"; "box_count"; "button_count"
        show_faces:           false
        colorscheme:          ~ # One of "light"; "dark"
        kid_directed_site:    false
    comments:
        width:                '550'
        order_by:             ~ # One of "social"; "reverse_time"; "time"
        colorscheme:          ~ # One of "light"; "dark"
        num_posts:            10
    activity_feed:
        action:               ''
        colorscheme:          ~ # One of "light"; "dark"
        filter:               ''
        header:               true
        height:               '300'
        linktarget:           _blank
        max_age:              '0'
        recommendations:      false
        ref:                  ''
        site:                 ''
        width:                '300'
    recommendations_feed:
        action:               ''
        colorscheme:          ~ # One of "light"; "dark"
        header:               true
        height:               '300'
        linktarget:           _blank
        max_age:              '0'
        ref:                  ''
        site:                 ''
        width:                '300'
    recommendations_bar:
        action:               ~ # One of "like"; "recommend"
        max_age:              '0'
        num_recommendations:  '2'
        read_time:            '30'
        ref:                  ''
        side:                 ~ # One of "left"; "right"
        site:                 ''
        trigger:              ''
    like_box:
        colorscheme:          ~ # One of "light"; "dark"
        force_wall:           false
        header:               true
        height:               '556'
        show_border:          true
        show_faces:           true
        stream:               true
        width:                '300'
    facepile:
        action:               like
        colorscheme:          ~ # One of "light"; "dark"
        max_rows:             '1'
        size:                 ~ # One of "small"; "medium"; "large"
        width:                '300'
</pre>
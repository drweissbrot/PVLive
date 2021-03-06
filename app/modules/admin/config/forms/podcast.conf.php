<?php 
return array(   
    'method'        => 'post',
    'enctype'       => 'multipart/form-data',

    'groups' => array(
        'profile' => array(
            'legend' => 'Basic Details',
            'elements' => array(

                'name' => array('text', array(
                    'label' => 'Name',
                    'class' => 'half-width',
                    'required' => true,
                )),

                'description' => array('textarea', array(
                    'label' => 'Podcast Description',
                    'description' => 'Tell us about what you do in the pony community, what projects you\'ve worked with, or how you want to contribute in the future.',
                    'class' => 'full-width half-height',
                )),

                'country' => array('select', array(
                    'label' => 'Country of Broadcast',
                    'multiOptions' => \PVL\Internationalization::getCountryLookup(),
                    'default' => '',
                )),

                'web_url' => array('text', array(
                    'label' => 'Web Site Address',
                    'class' => 'half-width',
                    'validators' => array('WebAddress'),
                )),

                'contact_email' => array('text', array(
                    'label' => 'Contact E-mail Address',
                    'description' => 'Include to show an e-mail link for the station on the "Contact Us" page.',
                    'validators' => array('EmailAddress'),
                    'class' => 'half-width',
                )),

                'image_url' => array('file', array(
                    'label' => 'Avatar (150x150 PNG)',
                    'description' => 'This is the small image that appears on your profile. Images should be under 150x150px in size. Larger images will automatically be scaled.',
                )),

                'banner_url' => array('file', array(
                    'label' => 'Promotional Banner (600x300 PNG)',
                    'description' => 'This image will be shown in the header rotator when new episodes are posted. Images should be 600x300.',
                )),

                'stations' => array('multiCheckbox', array(
                    'label' => 'Airs on Station(s)',
                    'description' => 'Select the station(s) that this podcast broadcasts on.',
                    'multiOptions' => \Entity\Station::fetchSelect(),
                )),

            ),
        ),

        'social' => array(
            'legend' => 'Social Networking Links',
            'description' => '
                Adding links to these services allows us to automatically update our users about your new releases and other social activity.<br>
                All fields are optional. Most of the time, your web address for these services will match the format shown in the field.
            ',

            'elements' => array(

                'rss_url' => array('text', array(
                    'label' => 'RSS Feed Address',
                    'class' => 'half-width',
                    'validators' => array('WebAddress'),
                )),

                'twitter_url' => array('text', array(
                    'label' => 'Twitter Address',
                    'class' => 'half-width',
                    'validators' => array('WebAddress'),
                    'placeholder' => 'http://www.twitter.com/YourUsername',
                )),

                'tumblr_url' => array('text', array(
                    'label' => 'Tumblr Address',
                    'class' => 'half-width',
                    'validators' => array('WebAddress'),
                    'placeholder' => 'http://YourUsername.tumblr.com',
                )),

                'facebook_url' => array('text', array(
                    'label' => 'Facebook Address',
                    'class' => 'half-width',
                    'validators' => array('WebAddress'),
                    'placeholder' => 'http://www.facebook.com/YourUserName',
                )),

                'youtube_url' => array('text', array(
                    'label' => 'YouTube Address',
                    'class' => 'half-width',
                    'validators' => array('WebAddress'),
                    'placeholder' => 'http://www.youtube.com/YourUsername',
                )),

                'soundcloud_url' => array('text', array(
                    'label' => 'SoundCloud Address',
                    'class' => 'half-width',
                    'validators' => array('WebAddress'),
                    'placeholder' => 'http://www.soundcloud.com/YourUsername',
                )),

                'deviantart_url' => array('text', array(
                    'label' => 'DeviantArt Address',
                    'class' => 'half-width',
                    'validators' => array('WebAddress'),
                    'placeholder' => 'http://YourUsername.deviantart.com',
                )),

                'livestream_url' => array('text', array(
                    'label' => 'LiveStream Address',
                    'class' => 'half-width',
                    'validators' => array('WebAddress'),
                    'placeholder' => 'http://livestream.com/username',
                )),

            ),
        ),

        'admin' => array(
            'legend' => 'Administrator Details',
            'elements' => array(
                'is_approved' => array('radio', array(
                    'label' => 'Is Approved',
                    'multiOptions' => array(
                        0   => 'No',
                        1   => 'Yes',
                    ),
                    'default' => 1
                )),
            ),
        ),

        'submit_grp' => array(
           'elements'       => array(
                'submit'        => array('submit', array(
                    'type'  => 'submit',
                    'label' => 'Save Changes',
                    'helper' => 'formButton',
                    'class' => 'ui-button',
                )),
            ),
        ),
    ),
);
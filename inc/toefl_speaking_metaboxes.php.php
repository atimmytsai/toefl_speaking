<?php if (!defined('ABSPATH'))
{
    die;
} // Cannot access directly.


// Example: /home/user/var/www/wordpress/wp-content/plugins/my-plugin/
// Set a unique slug-like ID as prefix for the custom metabox 
// Using Codestar framework http://codestarframework.com/documentation/

$prefix = 'toefl_speakings_options';

//
// Create a metabox
//
CSF::createMetabox($prefix, array(
    'title' => 'TOEFL Speaking',
    'post_type' => 'toefl_speakings',
    'priority' => 'high',
));

// Create a section
CSF::createSection($prefix, array(
    'fields' => array(

        array(
            'id'    =>  'question-title',
            'title'   => 'Quetion Title',
            'type'  =>  'text',
        ),

// Create task options with dependency fields
        array(
            'id' => 'task-selection',
            'type' => 'button_set',
            'title' => 'Question Type',
            'options' => array(
                'spk_task1' => 'Task 1',
                'spk_task2' => 'Task 2',
                'spk_task3' => 'Task 3',
                'spk_task4' => 'Task 4',
            ) ,
            'default' => 'spk_task1'
        ) ,


        array(
            'type' => 'content',
            'style' => 'normal',
            'content' => '<b> Task 1</b>: Question',
            'dependency' => array(
                'task-selection',
                '==',
                'spk_task1'
            ) ,
        ) ,

        array(
            'type' => 'content',
            'style' => 'normal',
            'content' => '<b> Task 2 </b> (Campus Announcement): Reading, Listening, Question',
            'dependency' => array(
                'task-selection',
                '==',
                'spk_task2'
            ) ,
        ) ,

        array(
            'type' => 'content',
            'style' => 'normal',
            'content' => '<b> Task 3</b> (Explain a Lecture) :  Reading, Listening, Question',
            'dependency' => array(
                'task-selection',
                '==',
                'spk_task3'
            ) ,
        ) ,

        array(
            'type' => 'content',
            'style' => 'normal',
            'content' => '<b> Task 4</b> (Summarize a Lecture): Listening, Question',
            'dependency' => array(
                'task-selection',
                '==',
                'spk_task4'
            ) ,
        ) ,

//
// Reading Passage
//
        array(
            'id' => 'reading-heading',
            'type' => 'subheading',
            'title' => 'Reading',
            'content' => 'reading material',
            'dependency' => array(
                'task-selection',
                'any',
                'spk_task2,spk_task3'
            ) ,
        ) ,

// Passage Title
        array(
            'id'    =>  'reading-title',
            'title'   => 'Passage Title',
            'type'  =>  'text',
            'dependency' => array(
                'task-selection',
                'any',
                'spk_task2,spk_task3'
            ) ,
        ) ,

// Passage text
        array(
            'id' => 'reading-text',
            'type' => 'wp_editor',
            'tinymce' => false,
            'quicktags' => true,
            'media_buttons' => false,
            'height' => '150px',
            'dependency' => array(
                'task-selection',
                'any',
                'spk_task2,spk_task3'
            ) ,
        ) ,

//
// Listening Material
//
        array(
            'id' => 'listening-heading',
            'type' => 'subheading',
            'title' => 'Listening',
            'content' => 'listening script and audio',
            'dependency' => array(
                'task-selection',
                'any',
                'spk_task2,spk_task3,spk_task4'
            ) ,
        ) ,
// Listening Script
        array(
            'id' => 'listening-text',
            'type' => 'wp_editor',
            'tinymce' => false,
            'quicktags' => true,
            'media_buttons' => false,
            'height' => '150px',
            'dependency' => array(
                'task-selection',
                'any',
                'spk_task2,spk_task3,spk_task4'
            ) ,
        ) ,
// Listening audio
        array(
            'id' => 'listening-audio',
            'type' => 'upload',
            'library' => 'audio',
            'button_title' => 'Upload listening mp3',
            'dependency' => array(
                'task-selection',
                'any',
                'spk_task2,spk_task3,spk_task4'
            ) ,
        ) ,


//
// Speaking Answer Group
// (multiple answers supported)
//

// Answer Group Heading
        array(
            'id' => 'answer_heading',
            'type' => 'subheading',
            'title' => 'Answer(s)',
            'content' => 'SAMPLE ANSWERS',
        ) ,

// Answer Group starts:
        array(
            'id'        => 'answer-group',
            'type'      => 'group',
            'min'       => '1',
            'button_title'  => 'Add New Answer',
            'fields'    => array(

// Answer title
                array(
                    'id'    => 'answer-title',
                    'title' => 'Answer POV',
                    'subtitle' => 'Agree, Disagree, Neutral, POV',
                    'type'  =>  'text',
                ),
// Answer Script
                array(
                    'id' => 'answer-text',
                    'title' => 'Answer Script',
                    'type' => 'textarea',
                ) ,
// Answer Audio
                array(
                    'id'        => 'answer-audio-group',
                    'type'      => 'repeater',
                    'title'     => 'Answer Recording',
                    'fields'    => 
                    array(
// -- Answer Audio
                        array(
                            'id' => 'answer-audio',
                            'type' => 'upload',
                            'library' => 'audio',
                            'button_title' => 'Upload Recording',
                        ),

                        array(
                            'id'        => 'answer-audio-teacher',
                            'type'      => 'image_select',

                            'options'   => array(
                                'none' =>  $teachers . 'none.png',
                                'Fatemeh' =>  $teachers . 'Fatemeh.png',
                                'Christie' =>  $teachers . 'Christie.png',
                                'Melissa' =>  $teachers . 'Melissa.png',
                                'Justice' =>  $teachers . 'Justice.png',
                                'Raj' =>  $teachers . 'Raj.png',
                                'Nayla' =>  $teachers . 'Nayla.png',
                                'Trevor' =>  $teachers . 'Trevor.png',

                            ),
                            'default'   => 'none'
                        ),         
                    ),
                ),


                array(
                    'id' => 'answer-explanation-header',
                    'title' => 'Answer Explanation',
                    'type' => 'subheading',

                ),

// Answer explanation
                array(
                    'id' => 'answer-explanation',
                    'type' => 'textarea',
                ),

            ),

//default
            'default'   => array(
                array(
                    'answer-title'     => 'AnswerPOV',
                ),
            ),

        ),
    )
));


//
// Metabox of the PAGE and POST both.
// Set a unique slug-like ID
//
$prefix_side = 'toefl_speakings_options_side';

CSF::createMetabox( $prefix_side, array(
    'title'          => 'TOEFL Speaking',
    'post_type'      => 'toefl_speakings',
    'context' => 'side',
    'priority' => 'high',
) );

CSF::createSection( $prefix_side, array(

'fields' => array(
// Listening audio
    array(
        'id' => 'question-audio',
        'type' => 'upload',
        'library' => 'audio',
        'title' => 'Question Audio',
        'button_title' => 'Add',
    ) ,


// Similar Question
    array(
        'id' => 'similar_question_date',
        'title' => 'Similar question seen on',
        'type' => 'date',

    ),


    array(
        'id'  => 'admin-note',
        'type' => 'text',
        'title' =>'Admin Note',
        'tinymce' => false,
        'quicktags' => false,
        'media_buttons' => false,
    ),

)
));

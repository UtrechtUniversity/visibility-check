<?php

namespace api;

class Questions
{
    private $config;
    private $questions = [];


    public function __construct($config){

        $this->config = $config;
    }


    public function getQuestions(){
        // Inizializza l'array per le domande
        $questions = [];


// Itera sulle domande nel YAML e crea gli oggetti JSON corrispondenti
        foreach ($this->config['questions'] as $questionIndex => $question) {
            $questionId = $questionIndex + 1;
            $options = [];
            foreach ($question['options'] as $optionIndex => $option) {
                $options[] = [
                    'id' => $optionIndex + 1,
                    'display_order' => $optionIndex + 1,
                    'question_id' => $questionId,
                    'value' => $option['value'],
                    'label' => $option['label']
                ];
            }

            $questions[] = [
                'id' => $questionId,
                'display_order' => $questionId,
                'url' => $question['url'],
                'type' => $question['type'],
                'topic_id' => $question['topic_id'],
                'text' => $question['text'],
                'linktext' => null,
                'linkurl' => null,
                'options' => $options,
            ];
        }

    }

}
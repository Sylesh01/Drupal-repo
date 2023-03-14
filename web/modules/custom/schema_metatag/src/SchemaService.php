<?php

namespace Drupal\schema_metatag;

Class SchemaService{

    public function prepareFaqSchema($vars){
            $str_faq_schema = '';
            foreach ($vars as $node) {
                $question =$node->field_question->value;
                $answer = $node->body->value;
                $faq_schema = " {
                '@type': 'Question',
                'name': ' $question  ',
                'acceptedAnswer': {
                    '@type': 'Answer',
                    'text': '$answer'
                }
                } ";
                
                $str_faq_schema .= $faq_schema;
                
            } 
    
            $final_faq_schema = "{
            '@context': 'https://schema.org',
            '@type': 'FAQPage',
            'mainEntity':  [$str_faq_schema]
            }";
            return $final_faq_schema;
    }
}
# Elasticsearch

````
PUT app_index
PUT app_index/_mapping/faq_questions
{
    "properties": {
        "id": {
            "type": "integer"
        },
        "question": {
            "type": "text"
        },  
        "answer": {
            "type": "text"
        },	
        "tags": {
            "type": "nested"
        }
    }
}

PUT app_index
PUT app_index/_mapping/faq_tags
{
    "properties": {
        "id": {
            "type": "integer"
        },
        "name": {
            "type": "string"
        },  
        "title": {
            "type": "string"
        }
    }
}
````

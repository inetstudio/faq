# Elasticsearch

````
curl -X PUT "localhost:9200/app_index_faq" -H 'Content-Type: application/json' -d'
{
   "mappings":{
      "properties":{
          "type": {
             "type":"keyword"
          },
          "id":{
             "type":"integer"
          },
          "is_published": {
             "type":"boolean"
          },
          "question":{
             "type":"text"
          },
          "answer":{
             "type":"text"
          }
       }
   }
}
'
````

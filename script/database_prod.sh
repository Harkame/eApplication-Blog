#!/bin/bash

heroku pg:reset DATABASE --app louis-daviaud-blog --confirm louis-daviaud-blog

heroku run php bin/console doctrine:schema:create -a louis-daviaud-blog

heroku run php bin/console doctrine:schema:update -a louis-daviaud-blog

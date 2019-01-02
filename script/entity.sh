#!/bin/bash


php bin/console generate:doctrine:entity --entity=AppBundle:Post --fields="title:string(length=100 nullable=false unique=true) alias_url:string(length=100 nullable=false unique=true) content:text(nullable=false unique=false) published:datetime(nullable=false unique=true)  image_url:string(length=255 nullable=true unique=false) author:string(length=255 nullable=true unique=false)"

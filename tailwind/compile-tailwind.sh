#!/bin/sh


npx update-browserslist-db@latest
npx tailwindcss -i ./src/input.css -o ./../cdn/css/app.css --minify 

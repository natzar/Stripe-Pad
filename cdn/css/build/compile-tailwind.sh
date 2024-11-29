#!/bin/sh


npx update-browserslist-db@latest
npx tailwindcss -i ./src/input.css -o ./../app.css --minify 

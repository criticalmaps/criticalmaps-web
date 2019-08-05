# criticalmaps-web

[![Build Status](https://travis-ci.org/criticalmaps/criticalmaps-web.svg?branch=master)](https://travis-ci.org/criticalmaps/criticalmaps-web)

Website repository for [criticalmaps.net](http://criticalmaps.net/)

## Run in development mode

```
docker build -f Dockerfile.dev -t criticalmaps-web . && docker run -v $(pwd):/go/src/github.com/criticalmaps/criticalmaps-web/ -p 3000:3000 criticalmaps-web
```

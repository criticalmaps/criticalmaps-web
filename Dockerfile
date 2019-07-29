FROM gobuffalo/buffalo:v0.14.6 as builder

RUN mkdir -p $GOPATH/src/github.com/criticalmaps/criticalmaps-web
WORKDIR $GOPATH/src/github.com/criticalmaps/criticalmaps-web

ADD package.json .
ADD yarn.lock .
RUN yarn install --no-progress
ADD . .

RUN go get $(go list ./... | grep -v /vendor/)
RUN buffalo build --static -o /bin/app

FROM alpine
RUN apk add --no-cache bash
RUN apk add --no-cache ca-certificates

WORKDIR /bin/

COPY --from=builder /bin/app .

# The following two env vars have to be overridden when running in production:
ENV GO_ENV=development
ENV SESSION_SECRET=topsecret

ENV ADDR=0.0.0.0
EXPOSE 3000

# Uncomment to run the migrations before running the binary:
# CMD /bin/app migrate; /bin/app
CMD exec /bin/app

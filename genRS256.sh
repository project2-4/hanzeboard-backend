ssh-keygen -t rsa -b 4096 -m PEM -f RS256.key
openssl rsa -in RS256.key -pubout -outform PEM -out RS256.key.pub
cat RS256.key
cat RS256.key.pub

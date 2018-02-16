const path = require('path')
const fastify = require('fastify')
const fastifyStatic = require('fastify-static')
const fs = require('fs')

const app = fastify({ logger: true })

const gpg = fs.readFileSync(path.join(__dirname, 'gpg-pub.txt'), 'utf8')

app.get('/gpg', (request, reply) => {
  reply
    .code(200)
    .header('Content-Type', 'text/plain; charset=us-ascii')
    .send(gpg)
})

app.register(fastifyStatic, {
  root: path.join(__dirname, 'dist'),
  prefix: '/',
})

app.listen(8080, err => {
  if (err) {
    throw err
  }
})

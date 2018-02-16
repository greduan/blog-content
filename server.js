const path = require('path')
const fastify = require('fastify')
const fastifyStatic = require('fastify-static')

const app = fastify({ logger: true })

app.register(fastifyStatic, {
  root: path.join(__dirname, 'dist'),
  prefix: '/',
})

app.listen(8080, err => {
  if (err) {
    throw err
  }
})

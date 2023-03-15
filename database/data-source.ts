import { DataSource } from 'typeorm'
import { join } from 'path'

export default new DataSource({
  type: 'mysql',
  host: 'localhost',
  port: 8889,
  username: 'root',
  password: 'root',
  database: 'vdev',
  entities: [join(__dirname, 'entities', '*.{ts,js}')],
  subscribers: [join(__dirname, 'subscribers', '*.{ts,js}')],
  synchronize: false,
  migrations: [join(__dirname, 'migrations', '*.{ts,js}')]
})

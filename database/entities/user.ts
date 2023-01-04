import { Column, Entity, PrimaryGeneratedColumn } from 'typeorm'

@Entity()
export class User {
  @PrimaryGeneratedColumn()
  id: number

  @Column({ unique: true })
  email: string

  @Column()
  password: string

  @Column({ name: 'first_name' })
  firstName: string

  @Column({ name: 'last_name' })
  lastName: string
}

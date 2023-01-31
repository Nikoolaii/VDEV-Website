import { Column, Entity, OneToMany, PrimaryGeneratedColumn } from 'typeorm'
import { Reservation } from './reservation'

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

  @OneToMany(() => Reservation, (reservation) => reservation.user)
  reservations: Reservation[]
}

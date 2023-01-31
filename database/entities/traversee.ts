import {
  Column,
  Entity,
  JoinColumn,
  ManyToOne,
  OneToMany,
  PrimaryGeneratedColumn
} from 'typeorm'
import { Bateau } from './bateau'
import { Reservation } from './reservation'
import { Liaison } from './liaison'

@Entity()
export class Traversee {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  date: Date

  @Column({ type: 'time' })
  heure: Date

  @ManyToOne(() => Bateau, (bateau) => bateau.traversees)
  @JoinColumn()
  bateau: Bateau

  @OneToMany(() => Reservation, (reservation) => reservation.traversee)
  reservations: Reservation[]

  @ManyToOne(() => Liaison, (liaison) => liaison.traversees)
  @JoinColumn()
  liaison: Liaison
}

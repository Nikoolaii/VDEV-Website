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

  @Column({ type: 'date' })
  date: Date

  @Column({ type: 'time' })
  heure: Date

  @ManyToOne(() => Bateau, (bateau) => bateau.traversees, {
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'bateau_id' })
  bateau: Bateau

  @OneToMany(() => Reservation, (reservation) => reservation.traversee)
  reservations: Reservation[]

  @ManyToOne(() => Liaison, (liaison) => liaison.traversees, {
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'liaison_id' })
  liaison: Liaison
}

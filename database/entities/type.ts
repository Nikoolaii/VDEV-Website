import {
  Column,
  Entity,
  JoinColumn,
  ManyToOne,
  OneToMany,
  PrimaryGeneratedColumn
} from 'typeorm'
import { Categorie } from './categorie'
import { Reservation } from './reservation'

@Entity()
export class Type {
  @PrimaryGeneratedColumn()
  id: string

  @Column()
  nom: string

  @ManyToOne(() => Categorie, (categorie) => categorie.types)
  @JoinColumn()
  categorie: Categorie

  @OneToMany(() => Reservation, (reservation) => reservation.type)
  reservations: Reservation[]
}

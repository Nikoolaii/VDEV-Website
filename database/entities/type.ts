import {
  Column,
  Entity,
  JoinColumn,
  ManyToOne,
  OneToMany,
  PrimaryColumn
} from 'typeorm'
import { Categorie } from './categorie'
import { Reservation } from './reservation'

@Entity()
export class Type {
  @PrimaryColumn()
  id: string

  @Column()
  nom: string

  @ManyToOne(() => Categorie, (categorie) => categorie.types)
  @JoinColumn()
  categorie: Categorie

  @OneToMany(() => Reservation, (reservation) => reservation.type)
  reservations: Reservation[]
}

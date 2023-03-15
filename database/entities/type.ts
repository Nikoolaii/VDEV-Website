import {
  Column,
  Entity,
  JoinColumn,
  ManyToMany,
  ManyToOne,
  OneToMany,
  PrimaryGeneratedColumn
} from 'typeorm'
import { Categorie } from './categorie'
import { Reservation } from './reservation'
import { LiaisonsTypesPeriodes } from './liaisonsTypesPeriodes'

@Entity()
export class Type {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  libelle: string

  @ManyToOne(() => Categorie, (categorie) => categorie.types, {
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'categorie_lettre' })
  categorie: Categorie

  @ManyToMany(() => Reservation, (reservation) => reservation.types, {
    onDelete: 'CASCADE'
  })
  reservations: Reservation[]

  @OneToMany(() => LiaisonsTypesPeriodes, (ltp) => ltp.type)
  laisonsTypesPeriodes: LiaisonsTypesPeriodes[]
}

import {
  Column,
  Entity,
  JoinColumn,
  ManyToOne,
  OneToMany,
  PrimaryGeneratedColumn
} from 'typeorm'
import { Secteur } from './secteur'
import { Port } from './port'
import { Traversee } from './traversee'

@Entity()
export class Liaison {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  distance: number

  @ManyToOne(() => Secteur, (secteur) => secteur.liaisons)
  @JoinColumn()
  secteur: Secteur

  @ManyToOne(() => Port, (port) => port.liaisons)
  @JoinColumn()
  depart: Port

  @ManyToOne(() => Port, (port) => port.liaisons)
  @JoinColumn()
  arrivee: Port

  @OneToMany(() => Traversee, (traversee) => traversee.liaison)
  traversees: Traversee[]
}

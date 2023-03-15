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
import { LiaisonsTypesPeriodes } from './liaisonsTypesPeriodes'

@Entity()
export class Liaison {
  @PrimaryGeneratedColumn()
  id: number

  @Column({ type: 'float' })
  distance: number

  @Column({ name: 'image_link', nullable: true })
  imageLink?: string

  @ManyToOne(() => Secteur, (secteur) => secteur.liaisons, {
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'secteur_id' })
  secteur: Secteur

  @ManyToOne(() => Port, (port) => port.liaisons, {
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'depart_id' })
  depart: Port

  @ManyToOne(() => Port, (port) => port.liaisons, {
    onDelete: 'CASCADE'
  })
  @JoinColumn({ name: 'arrivee_id' })
  arrivee: Port

  @OneToMany(() => Traversee, (traversee) => traversee.liaison)
  traversees: Traversee[]

  @OneToMany(() => LiaisonsTypesPeriodes, (ltp) => ltp.liaison)
  laisonsTypesPeriodes: LiaisonsTypesPeriodes[]
}

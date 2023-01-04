import { Column, Entity, ManyToOne, PrimaryGeneratedColumn } from 'typeorm'
import { Secteur } from './secteur'
import { Port } from './port'

@Entity()
export class Liaison {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  distance: number

  @ManyToOne(() => Secteur, (secteur) => secteur.liaisons)
  secteur: Secteur

  @ManyToOne(() => Port, (port) => port.liaisons)
  depart: Port

  @ManyToOne(() => Port, (port) => port.liaisons)
  arrivee: Port
}

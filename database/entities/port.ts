import { Column, Entity, OneToMany, PrimaryGeneratedColumn } from 'typeorm'
import { Liaison } from './liaison'

@Entity()
export class Port {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  nom: string

  @OneToMany(() => Liaison, (liaison) => liaison.depart || liaison.arrivee)
  liaisons: Liaison[]
}

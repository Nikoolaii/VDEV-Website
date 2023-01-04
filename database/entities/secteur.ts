import { Column, Entity, OneToMany, PrimaryGeneratedColumn } from 'typeorm'
import { Liaison } from './liaison'

@Entity()
export class Secteur {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  nom: string

  @OneToMany(() => Liaison, (liaison) => liaison.secteur)
  liaisons: Liaison[]
}

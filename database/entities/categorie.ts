import {
  Column,
  Entity,
  JoinColumn,
  ManyToOne,
  OneToMany,
  PrimaryColumn
} from 'typeorm'
import { Bateau } from './bateau'
import { Type } from './type'

@Entity()
export class Categorie {
  @PrimaryColumn()
  lettre: string

  @Column()
  nom: string

  @Column({ name: 'capacite_max' })
  capaciteMax: number

  @ManyToOne(() => Bateau, (bateau) => bateau.categories)
  @JoinColumn()
  bateau: Bateau

  @OneToMany(() => Type, (type) => type.categorie)
  types: Type[]
}

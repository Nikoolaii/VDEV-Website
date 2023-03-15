import { Column, Entity, ManyToMany, OneToMany, PrimaryColumn } from 'typeorm'
import { Bateau } from './bateau'
import { Type } from './type'

@Entity()
export class Categorie {
  @PrimaryColumn()
  lettre: string

  @Column()
  nom: string

  @ManyToMany(() => Bateau, (bateau) => bateau.categories, {
    onDelete: 'CASCADE'
  })
  bateaux: Bateau[]

  @OneToMany(() => Type, (type) => type.categorie)
  types: Type[]
}

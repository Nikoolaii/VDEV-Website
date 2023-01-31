import { Column, Entity, OneToMany, PrimaryGeneratedColumn } from 'typeorm'
import { Categorie } from './categorie'
import { Traversee } from './traversee'

@Entity()
export class Bateau {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  nom: string

  @Column()
  longueur: number

  @Column()
  largeur: number

  @Column()
  vitesse: number

  @OneToMany(() => Categorie, (categorie) => categorie.bateau)
  categories: Categorie[]

  @OneToMany(() => Traversee, (traversee) => traversee.bateau)
  traversees: Traversee[]
}

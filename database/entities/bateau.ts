import {
  Column,
  Entity,
  JoinTable,
  ManyToMany,
  OneToMany,
  PrimaryGeneratedColumn,
  TableInheritance
} from 'typeorm'
import { Categorie } from './categorie'
import { Traversee } from './traversee'

@Entity()
@TableInheritance({ column: { type: 'varchar', name: 'type' } })
export class Bateau {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  nom: string

  @ManyToMany(() => Categorie, (categorie) => categorie.bateaux, {
    onDelete: 'CASCADE'
  })
  @JoinTable({
    name: 'bateaux_categories',
    joinColumn: {
      name: 'bateau_id',
      referencedColumnName: 'id'
    },
    inverseJoinColumn: {
      name: 'categorie_lettre',
      referencedColumnName: 'lettre'
    }
  })
  categories: Categorie[]

  @OneToMany(() => Traversee, (traversee) => traversee.bateau)
  traversees: Traversee[]
}

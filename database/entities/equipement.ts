import {
  Column,
  Entity,
  JoinTable,
  ManyToMany,
  ManyToOne,
  PrimaryGeneratedColumn
} from 'typeorm'
import { BateauVoyageur } from './bateauVoyageur'

@Entity()
export class Equipement {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  nom: string

  @ManyToMany(
    () => BateauVoyageur,
    (bateauVoyageur) => bateauVoyageur.equipements,
    {
      onDelete: 'CASCADE'
    }
  )
  @JoinTable({
    name: 'bateau_voyageur_equipement',
    joinColumn: {
      name: 'equipement_id',
      referencedColumnName: 'id'
    },
    inverseJoinColumn: {
      name: 'bateau_voyageur_id',
      referencedColumnName: 'id'
    }
  })
  bateauVoyageurs: BateauVoyageur[]
}

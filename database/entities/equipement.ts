import { Column, Entity, ManyToOne, PrimaryGeneratedColumn } from 'typeorm'
import { BateauVoyageur } from './bateauVoyageur'

@Entity()
export class Equipement {
  @PrimaryGeneratedColumn()
  id: number

  @Column()
  nom: string

  @ManyToOne(
    () => BateauVoyageur,
    (bateauVoyageur) => bateauVoyageur.equipements,
    {
      onDelete: 'CASCADE'
    }
  )
  bateauVoyageur: BateauVoyageur
}

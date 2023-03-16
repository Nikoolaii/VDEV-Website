import { ChildEntity, Column, ManyToMany, OneToMany } from 'typeorm'
import { Bateau } from './bateau'
import { Equipement } from './equipement'

@ChildEntity('Voyageur')
export class BateauVoyageur extends Bateau {
  @Column({ type: 'float' })
  longueur: number

  @Column({ type: 'float' })
  largeur: number

  @Column({ type: 'float' })
  vitesse: number

  @ManyToMany(() => Equipement, (equipement) => equipement.bateauVoyageurs)
  equipements: Equipement[]
}

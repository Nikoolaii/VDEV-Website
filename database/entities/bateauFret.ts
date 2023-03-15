import { ChildEntity, Column } from 'typeorm'
import { Bateau } from './bateau'

@ChildEntity('Fret')
export class BateauVoyageur extends Bateau {
  @Column({ type: 'float', name: 'poids_max' })
  poidsMax: number
}

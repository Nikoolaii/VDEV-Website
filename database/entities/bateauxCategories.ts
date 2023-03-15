import { Column, Entity, PrimaryColumn } from 'typeorm'

@Entity('bateaux_categories')
export class BateauxCategories {
  @PrimaryColumn({ name: 'bateau_id' })
  bateauId: number

  @PrimaryColumn({ name: 'categorie_lettre' })
  categorieLettre: string

  @Column({ name: 'capacite_max' })
  capaciteMax: number
}

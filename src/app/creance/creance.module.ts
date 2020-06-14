import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {CreanceRouting} from './creance.routing';
import {AllCreancesComponent} from './all/all.creances.component';
import {DataTablesModule} from 'angular-datatables';



@NgModule({
  declarations: [
    AllCreancesComponent
  ],
  imports: [
    CommonModule,
    CreanceRouting,
    DataTablesModule
  ]
})
export class CreanceModule { }

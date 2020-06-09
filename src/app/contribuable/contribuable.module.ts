import {NgModule} from '@angular/core';
import {ContribuableRouting} from './contribuable.routing';
import {AllContribuableComponent} from './all/all.contribuable.component';
import {AddContribuableComponent} from './new/add.contribuable.component';
import {EditContribuableComponent} from './edit/edit.contribuable.component';
import {AuthGuard} from '../services/security/auth.guard';
import {CommonModule} from '@angular/common';
import {DataTablesModule} from 'angular-datatables';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

@NgModule({
  declarations: [
    AllContribuableComponent,
    AddContribuableComponent,
    EditContribuableComponent
  ],
  imports: [
    CommonModule,
    ContribuableRouting,
    DataTablesModule,
    FormsModule,
    ReactiveFormsModule,
  ],
  providers: [AuthGuard],
  entryComponents: [EditContribuableComponent]
})
export class ContribuableModule { }

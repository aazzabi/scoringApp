import {NgModule} from '@angular/core';
import {AddCritereComponent} from './new/add.critere.component';
import {EditCritereComponent} from './edit/edit.critere.component';
import {DataTablesModule} from 'angular-datatables';
import {CommonModule} from '@angular/common';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {AllCritereComponent} from './all/all.critere.component';
import {CritereRouting} from './critere.routing';
import {ShowCritereComponent} from './show/show.critere.component';

@NgModule({
  declarations: [
    AllCritereComponent,
    AddCritereComponent,
    ShowCritereComponent,
    EditCritereComponent
  ],
  imports: [
    CommonModule,
    CritereRouting,
    DataTablesModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [],
  // entryComponents: [EditUserComponent]
})
export class CritereModule {
}

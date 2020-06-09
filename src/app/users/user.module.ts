import {NgModule} from '@angular/core';
import {UserRouting} from './user.routing';
import {AllUserComponent} from './all/all.user.component';
import {AddUserComponent} from './new/add.user.component';
import {EditUserComponent} from './edit/edit.user.component';
import {DataTablesModule} from 'angular-datatables';
import {CommonModule} from '@angular/common';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

@NgModule({
  declarations: [
    AllUserComponent,
    AddUserComponent,
    EditUserComponent
  ],
  imports: [
    CommonModule,
    UserRouting,
    DataTablesModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [],
  entryComponents: [EditUserComponent]
})
export class UserModule {
}

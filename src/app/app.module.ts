import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

import { ListentrepriseComponent } from './entreprise/listentreprise/listentreprise.component';
import { AjoutentrepriseComponent } from './entreprise/ajoutentreprise/ajoutentreprise.component';
import { UpdateentrepriseComponent } from './entreprise/updateentreprise/updateentreprise.component';
import { LoginComponent } from './login/login.component';
import { MenuComponent } from './menu/menu.component';

@NgModule({
  declarations: [
    AppComponent,
    ListentrepriseComponent,
    AjoutentrepriseComponent,
    UpdateentrepriseComponent,
    LoginComponent,
    MenuComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

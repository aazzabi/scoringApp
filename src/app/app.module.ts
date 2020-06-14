import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import {ROUTING} from './app-routing.module';
import { AppComponent } from './app.component';
import {HTTP_INTERCEPTORS, HttpClientModule} from '@angular/common/http';
import { FormsModule } from '@angular/forms';

import { LoginComponent } from './login/login.component';
import { MenuComponent } from './menu/menu.component';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {RouterModule} from '@angular/router';
import {NavbarModule} from './theme/shared/navbar/navbar.module';
import {FooterModule} from './theme/shared/footer/footer.module';
import {SidebarModule} from './theme/sidebar/sidebar.module';
import {AdminLayoutComponent} from './theme/layouts/admin-layout/admin-layout.component';
import {ContribuableModule} from './contribuable/contribuable.module';
import {LoginService} from './services/security/login.service';
import {RoleGuard} from './services/security/role.guard';
import {AuthIntercepter} from './services/security/auth.intercepter';
import {ErrorInterceptor} from './services/security/error.intercepter';
import {AlertService} from './services/common/AlertService';
import {AlertComponent} from './alerteJumbotron/alert.component';
import {AuthGuard} from './services/security/auth.guard';
import {UserModule} from './users/user.module';
import {DataTablesModule} from 'angular-datatables';
import {ContribuableService} from './services/manager/ContribuableService';
import {AllContribuablesResolverService} from './services/resolvers/all.contribuables.resolver.service';
import {AllUsersResolverService} from './services/resolvers/all.users.resolver.service';
import {UsersService} from './services/manager/UserService';
import {GetUserByIdResolverService} from './services/resolvers/get.user.by.id.resolver.service';
import {GetContribuableByIdResolverService} from './services/resolvers/get.contribuable.by.id.resolver.service';
import {NgbModalModule} from '@ng-bootstrap/ng-bootstrap';
import {CritereModule} from './Critere/critere.module';
import {CriteresService} from './services/manager/CriteresService';
import {AllCritereResolverService} from './services/resolvers/all.criteres.resolver.service';
import {GetCritereByIdResolverService} from './services/resolvers/get.critere.by.id.resolver.service';
import {GetChoixByIdCritereResolverService} from './services/resolvers/get.choix.by.id.critere.resolver.service';
import {ChoixService} from './services/manager/ChoixService';
import {CreancesService} from './services/manager/CreancesService';
import {AllCreancesResolverService} from './services/resolvers/all.creances.resolver.service';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    MenuComponent,
    AdminLayoutComponent,
    AlertComponent
  ],
  imports: [
    BrowserModule,
    CritereModule,
    DataTablesModule,
    ROUTING,
    HttpClientModule,
    ContribuableModule,
    UserModule,
    FormsModule,
    BrowserAnimationsModule,
    FormsModule,
    RouterModule,
    HttpClientModule,
    NavbarModule,
    FooterModule,
    SidebarModule,
    NgbModalModule
  ],
  providers: [
    LoginService,
    RoleGuard,
    UsersService,
    ContribuableService,
    ChoixService,
    CreancesService,
    CriteresService,
    AllCritereResolverService,
    GetCritereByIdResolverService,
    GetChoixByIdCritereResolverService,
    AllUsersResolverService,
    AllCreancesResolverService,
    GetUserByIdResolverService,
    AllContribuablesResolverService,
    GetContribuableByIdResolverService,
    AlertService,
    AuthGuard,
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthIntercepter,
      multi: true
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: ErrorInterceptor,
      multi: true
    },
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }

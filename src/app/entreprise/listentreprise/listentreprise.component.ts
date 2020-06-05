import { Component, OnInit } from '@angular/core';

import{ EntrepriseService } from 'src/app/services/entreprise.service';


@Component({
  selector: 'app-listentreprise',
  templateUrl: './listentreprise.component.html',
  styleUrls: ['./listentreprise.component.css']
})
export class ListentrepriseComponent implements OnInit {
public entreprises:any=[];
public token;
  constructor(private entrserv:EntrepriseService) { 
 // this.token = localStorage.getItem('token')? JSON.parse(localStorage.getItem('token')) : '';
 this.token = localStorage.getItem('token');
 
}
  ngOnInit() {
    this.loadEntreprises();
  }
loadEntreprises(){
  return this.entrserv.ListEntreprise().subscribe(data=>{this.entreprises=data;})
}
DeleteEntreprise(id){
  return this.entrserv.DeleteEntreprise(id).subscribe(data=>{this.loadEntreprises()});
}
}

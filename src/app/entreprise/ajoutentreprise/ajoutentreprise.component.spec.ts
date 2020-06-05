import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AjoutentrepriseComponent } from './ajoutentreprise.component';

describe('AjoutentrepriseComponent', () => {
  let component: AjoutentrepriseComponent;
  let fixture: ComponentFixture<AjoutentrepriseComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AjoutentrepriseComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AjoutentrepriseComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

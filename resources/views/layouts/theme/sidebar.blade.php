<div class="deznav" style="background-color: white;margin-top:-80px;height:100%;position:fixed;">
        <div class="deznav-scroll">
            <ul  class="metismenu"  id="menu">

                <li><a href="/" class="ai-icon mt-2" aria-expanded="false" >
                        <i style="color: #60060F;"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg></i>
                        <span  class="nav-text" style="color:#60060F">{{Auth::user()->role=='maestro' ? 'Maestros' : 'Alumnos'}}</span>
                    </a>
                </li>
                @if(Auth::user()->role=='coordinador')

                <li><a href="maestros" class="ai-icon mt-2" aria-expanded="false" >
                        <i style="color: #60060F;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="#2C3E50" fill="none" stroke-linecap="round" stroke-linejoin="round" width="44" height="44" stroke-width="2">
                            <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                            <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
                            </svg></i>
                        <span  class="nav-text" style="color:#60060F">Maestros</span>
                    </a>
                </li>
                <li><a href="planeacion" class="ai-icon" aria-expanded="false">
                        <i  style="color: #60060F;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2C3E50" stroke-linecap="round" stroke-linejoin="round" width="44" height="44" stroke-width="2">
                            <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path>
                            <path d="M14 19l2 2l4 -4"></path>
                            <path d="M9 8h4"></path>
                            <path d="M9 12h2"></path>
                            </svg></i>
                        <span  class="nav-text" style="color:#60060F">Planeación</span>
                    </a>
                </li>
                <li><a href="grupos" class="ai-icon" aria-expanded="false">
                        <i  style="color: #60060F;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2C3E50" stroke-linecap="round" stroke-linejoin="round" width="44" height="44" stroke-width="2">
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                            </svg></i>
                        <span  class="nav-text" style="color:#60060F">Grupos</span>
                    </a>
                </li>
                <li><a href="carreras" class="ai-icon" aria-expanded="false">
                        <i  style="color: #60060F;"><svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size" x-bind:height="size" viewBox="0 0 24 24" fill="#2C3E50" width="44" height="44">
                            <path d="M10 3h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z"></path>
                            <path d="M20 3h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z"></path>
                            <path d="M10 13h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z"></path>
                            <path d="M17 13a4 4 0 1 1 -3.995 4.2l-.005 -.2l.005 -.2a4 4 0 0 1 3.995 -3.8z"></path>
                            </svg></i>
                        <span  class="nav-text" style="color:#60060F">Carreras</span>
                    </a>
                </li>
                <li><a href="horarios" class="ai-icon" href="javascript:void()" aria-expanded="false">
                        <i style="color: #60060F;"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-month" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                            <path d="M16 3v4" />
                            <path d="M8 3v4" />
                            <path d="M4 11h16" />
                            <path d="M7 14h.013" />
                            <path d="M10.01 14h.005" />
                            <path d="M13.01 14h.005" />
                            <path d="M16.015 14h.005" />
                            <path d="M13.015 17h.005" />
                            <path d="M7.01 17h.005" />
                            <path d="M10.01 17h.005" />
                            </svg></i>
                        <span  class="nav-text" style="color:#60060F" >Horarios</span>
                    </a>
                </li>
                <li><a href="materias" class="ai-icon" aria-expanded="false">
                        <i style="color: #60060F;"><svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size" x-bind:height="size" viewBox="0 0 24 24" fill="none" stroke="#2C3E50" x-bind:stroke-width="stroke" stroke-linecap="round" stroke-linejoin="round" width="44" height="44" stroke-width="2">
                            <path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                            <path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                            <path d="M5 8h4"></path>
                            <path d="M9 16h4"></path>
                            <path d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z"></path>
                            <path d="M14 9l4 -1"></path>
                            <path d="M16 16l3.923 -.98"></path>
                            </svg></i>
                        <span  class="nav-text" style="color:#60060F">Materias</span>
                    </a>
                </li>
                <li><a href="salones" class="ai-icon" aria-expanded="false">
                        <i style="color: #60060F;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2C3E50" stroke-linecap="round" stroke-linejoin="round" width="44" height="44" stroke-width="2">
                            <path d="M14 12v.01"></path>
                            <path d="M3 21h18"></path>
                            <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16"></path>
                            </svg></i>
                        <span  class="nav-text" style="color:#60060F">Salones</span>
                    </a>
                </li>
                <li id="ajustes"><a href="usuarios" class="ai-icon" aria-expanded="false">
                        <i style="color: #60060F;"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg></i>
                        <span  class="nav-text" style="color:#60060F">Usuarios</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
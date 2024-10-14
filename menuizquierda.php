<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="index.html">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li> --><!-- End Dashboard Nav -->
<?php if(($_SESSION['tipo'] == 0)or($_SESSION['tipo'] == 1)){?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Administrar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="#">
              <span>Items</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span>Responsables</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span>Conductores</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span>Placas</span>
            </a>
          </li>
        </ul>
      </li>
<?php }?>      
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Planta Desposte</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        
        <ul id="forms-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <?php if(($_SESSION['tipo'] == 0)or($_SESSION['tipo'] == 1)){?>  
          <li>
            <a href="recepcion.php">
              <span>Recepción</span>
            </a>
          </li>
          <li>
            <a href="pesosRecepcion.php">
              <span>Pesos Recepción</span>
            </a>
          </li>
          <li>
            <a href="despacho.php">
              <span>Despacho</span>
            </a>
          </li> 
        <?php }elseif($_SESSION['tipo'] == 2){?>
          
        <?php }?>
        </ul>

      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav2" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Planta Desprese</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        
        <ul id="forms-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <?php if(($_SESSION['tipo'] == 0)or($_SESSION['tipo'] == 1)){?>  
          <li>
            <a href="despachopollo.php">
              <span>Despacho Pollo</span>
            </a>
          </li> 
        <?php }elseif($_SESSION['tipo'] == 2){?>
          
        <?php }?>
        </ul>

      </li>    
    </ul>

  </aside>
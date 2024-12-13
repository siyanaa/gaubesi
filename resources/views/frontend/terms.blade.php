@extends("frontend.layouts.master")
@section("content")
<style>
    .policy_term {
        background: var(--border-color);
        padding: 10px 0;
        cursor: pointer;
        font-weight: 400;
    }
    .line {
        border-bottom: 2px solid var(--border-color);
        padding-bottom: 8px;
        width: 98%;
    }
    .activecolor {
        background: var(--off-green);
        padding: 10px 0;
        color: var(--pure-white);
    }
    .policycircle {
        border: 2px solid var(--off-green);
        height: calc(6px + 4vh);
        width: calc(11px + 4vh);
        ;
        border-radius: var(--radius100);
    }
    @media (max-width:700px) {
        .policycircle {
            height: calc(2px + 4vh);
            width: calc(10px + 10vh);
        }
        .policy_term {
            font-size: 16px;
        }
    }
    #returnpolicy,
    #termandcondition {
        display: none;
    }
</style>
<!-- herosection -->
<section class="container-fluid mt-4 ">
    <div class="container">
        <span class="lg-texts ">Policy </span>
        <p class="line mt-3"></p>
    </div>
</section>
<section class="container-fluid py-2">
    <div class="container">
        <div class="row m-0 p-0">
            <div class="col-12 row ">
                <span class="col-4 text-center sm-text-bd policy_term activecolor" onclick="changepolicyandterm(this)"
                    data-id="ourpolicy">what are our Policy </span>
                <span class="col-4 text-center   policy_term sm-text-bd" onclick="changepolicyandterm(this)"
                    data-id="returnpolicy">Return
                    Policy</span>
                <span class="col-4 text-center policy_term sm-text-bd" onclick="changepolicyandterm(this)"
                    data-id="termandcondition">terms and
                    condition</span>
            </div>
            <div class="col-12 row py-4 gap-5">
                <div class="col-md-7    ">
                 <!-- our policy -->
<div class="col-12 my-3" id="ourpolicy">
    @if($ourPolicy)
        @foreach($ourPolicy as $index => $description)
            <div class="d-flex line my-1">
                <span class="policycircle xs-text text-align-center justify-content-center text-center">{{ $index + 1 }}</span>
                <span class="xs-text mx-2">{{ $description }}</span>
            </div>
        @endforeach
    @else
        <span class="xs-text">Description not available.</span>
    @endif
</div>

<!-- return policy -->
<div class="col-12 my-3" id="returnpolicy">
    @if($returnPolicy)
        @foreach($returnPolicy as $index => $description)
            <div class="d-flex">
                <span class="policycircle xs-text text-align-center justify-content-center text-center">{{ $index + 1 }}</span>
                <span class="xs-text mx-2">{{ $description }}</span>
            </div>
        @endforeach
    @else
        <span class="xs-text">Description not available.</span>
    @endif
</div>

<!-- terms and condition -->
<div class="col-12 xs-text align-items-center my-3" id="termandcondition">
    <ol type="I">
        @if($termsAndCondition)
            @foreach($termsAndCondition as $description)
                <li class="xs-text my-3">{{ $description }}</li>
            @endforeach
        @else
            <li class="xs-text my-3">Description not available.</li>
        @endif
    </ol>
</div>
</div>

             <!-- condition of return -->
             <div class="col-md-4 paddingbox">
                <h2 class="md-text text-center"> Conditions for Returns</h2>
                <ul class="mt-4">
                    <li class="xs-text mt-2">
                        @if($returnCondition)
                        @foreach($returnCondition as $description)
                            <li class="xs-text my-3">{{ $description }}</li>
                        @endforeach
                    @else
                        <li class="xs-text my-3">Description not available.</li>
                    @endif
                    </li>
                </ul>
            </div>
                
            </div>
        </div>
    </div>
</section>
<script>
    function changepolicyandterm(element) {
        const policy_term = document.querySelectorAll(".policy_term");
        const clickitems = element.getAttribute("data-id");
        const getpolicy = document.querySelector("#ourpolicy");
        const getReturnpolicy = document.querySelector("#returnpolicy");
        const getTermsandcondition = document.querySelector("#termandcondition");
        getpolicy.style.display = "none";
        getReturnpolicy.style.display = "none";
        getTermsandcondition.style.display = "none";
        policy_term.forEach(items => {
            items.classList.remove("activecolor");
        });
        element.classList.add("activecolor");
        if (clickitems === "ourpolicy") {
            getpolicy.style.display = "block";
        }
        else if (clickitems === "returnpolicy") {
            getReturnpolicy.style.display = "block";
        }
        else if (clickitems === "termandcondition")
            getTermsandcondition.style.display = "block";
    }
</script>
{{--
<div class="row col-10 ">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item my-2 py-2">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Accordion Item #1
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to
                    demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion
                    body.</div>
            </div>
        </div>
    </div>
</div>
--}}
@endsection
<template>
  <hero style="left: 32%;" title="Contact Us" :showMenu="false" />
  <section class="container my-5">
    <div class="font-size-22 font-weight-600">
      Join With Us
    </div>
  </section>
  <section class="container">
    <div class="row g-5">
      <div class="col-md-6">
        <div
          class="card border-p-black position-relative pb-5"
          style="border-radius: 0 !important;"
        >
          <div
            class="card-header bg-p-orange-9"
            style="border-radius: 0 !important;"
          >
            <div class="font-size-18 font-weight-700 text-center">
              Benefit join Becoome a Customer
            </div>
          </div>
          <div class="card-body p-0">
            <div class="font-size-16 font-weight-400 pt-5 pb-4 px-5">
              <ol>
                <li>Contactable key account officer.</li>
                <li>Trusted and validated supplier.</li>
                <li>Consistency of supply and quality.</li>
                <li>Extensive Market Reach.</li>
                <li>Streamlined Trading Process.</li>
                <li>Competitive Pricing.</li>
                <li>Reliable Logistics and Distribution.</li>
              </ol>
            </div>
            <div
              class="w-100 d-flex align-items-center justify-content-center"
              style="position: absolute; bottom: -6%;"
            >
              <router-link
                to="/become-a-customer"
                class="btn btn-p-grey-57 px-4 rounded-0"
              >
                Become a Customer
              </router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div
          class="card border-p-black pb-5"
          style="border-radius: 0 !important;"
        >
          <div
            class="card-header bg-p-orange-9"
            style="border-radius: 0 !important;"
          >
            <div class="font-size-18 font-weight-700 text-center">
              Benefit join Becoome a Supplier
            </div>
          </div>
          <div class="card-body p-0">
            <div class="font-size-16 font-weight-400 pt-5 pb-4 px-5">
              <ol>
                <li>Expanded Market Access.</li>
                <li>Reliable Demand and Consistent Sales.</li>
                <li>Streamlined Supply Chain Management.</li>
                <li>Risk Mitigation.</li>
                <li>Quality Assurance and Compliance.</li>
                <li>Industry Connections and Partnerships.</li>
                <li>Company Brand Enhancement and Credibility.</li>
                <li>Guidance to Improve Product.</li>
              </ol>
            </div>
            <div class="text-center py-2">
              <div
                class="w-100 d-flex align-items-center justify-content-center"
                style="position: absolute; bottom: -5%;"
              >
                <router-link
                  to="/become-a-supplier"
                  class="btn btn-p-grey-57 px-4 rounded-0"
                >
                  Become a Supplier
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section style="padding: 110px 0px;">
    <div
      style="
        background: url('/assets/images/side-contact-us.png');
        height: 450px;
        background-repeat: no-repeat;
        background-position: right;
      "
    ></div>
  </section>
</template>

<script>
import Hero from "@/components/Hero.vue";
import InputGroup from "@/components/InputGroup.vue";
import SelectGroup from "@/components/SelectGroup.vue";
export default {
  components: {
    Hero,
    InputGroup,
    SelectGroup,
  },
  name: "ContactUs",
};
</script>
